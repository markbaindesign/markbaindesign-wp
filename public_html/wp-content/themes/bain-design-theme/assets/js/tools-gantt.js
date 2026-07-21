/**
 * Bain Design — tools timeline Gantt chart.
 * D3-driven: time scale, greedy-packed lanes (computed server-side), ctrl/cmd+wheel
 * zoom, smooth filter transitions, custom tooltip. Renders into #tools-gantt-root.
 */
(function () {
	'use strict';

	if (typeof d3 === 'undefined') return;

	const root = document.getElementById('tools-gantt-root');
	const dataEl = document.getElementById('tools-gantt-data');
	if (!root || !dataEl) return;

	let data;
	try {
		data = JSON.parse(dataEl.textContent);
	} catch (e) {
		return;
	}
	if (!data || !data.tracks || !data.tracks.length) return;

	const LANE_HEIGHT = 28;
	const LABEL_WIDTH = 150;
	const AXIS_HEIGHT = 32;
	const PX_PER_MONTH = 22;

	const parseDate = d3.timeParse('%Y-%m-%d');
	const today = parseDate(data.today);

	let minDate = today;
	data.tracks.forEach(track => {
		track.tools.forEach(t => {
			t.startDate = parseDate(t.start);
			t.endDate = parseDate(t.end);
			t.sunsetDate = t.sunset ? parseDate(t.sunset) : null;
			if (t.startDate < minDate) minDate = t.startDate;
		});
	});
	minDate = d3.timeYear.floor(minDate);

	const totalMonths = d3.timeMonth.count(minDate, today) + 1;
	const baseWidth = totalMonths * PX_PER_MONTH;

	// Reversed domain: today at x=0 (left), oldest date at x=baseWidth (right).
	const baseX = d3.scaleTime().domain([today, minDate]).range([0, baseWidth]);

	root.innerHTML = '';
	root.classList.add('tools-gantt');

	const scroll = d3.select(root).append('div').attr('class', 'tools-gantt__scroll');

	// ---- Ruler ----
	const ruler = scroll.append('div').attr('class', 'tools-gantt__ruler');
	ruler.append('div').attr('class', 'tools-gantt__corner');
	const rulerTrack = ruler.append('div')
		.attr('class', 'tools-gantt__ruler-track')
		.style('width', baseWidth + 'px');

	// ---- Tracks ----
	const trackRows = scroll.selectAll('.tools-gantt__track')
		.data(data.tracks, d => d.slug)
		.enter()
		.append('div')
		.attr('class', 'tools-gantt__track')
		.attr('data-tools-category', d => d.slug)
		.style('height', d => (d.laneCount * LANE_HEIGHT) + 'px');

	trackRows.append('div')
		.attr('class', 'tools-gantt__track-label')
		.style('height', d => (d.laneCount * LANE_HEIGHT) + 'px')
		.text(d => d.category);

	const lanesArea = trackRows.append('div')
		.attr('class', 'tools-gantt__track-lanes')
		.style('width', baseWidth + 'px')
		.style('height', d => (d.laneCount * LANE_HEIGHT) + 'px');

	// ---- Tooltip ----
	const tooltip = d3.select(root).append('div').attr('class', 'tools-gantt__tooltip');

	function showTooltip(event, d) {
		const fmt = d3.timeFormat('%Y');
		let range = fmt(d.startDate) + ' — ' + (d.status === 'ended' ? fmt(d.endDate) : 'present');
		if (d.status === 'sunset') {
			range += ' · sunset since ' + fmt(d.sunsetDate);
		} else if (d.status === 'ended' && d.sunsetDate) {
			range += ' · sunset from ' + fmt(d.sunsetDate);
		}
		tooltip.html(
			'<strong>' + d.name + '</strong>' +
			'<span class="tools-gantt__tooltip-range">' + range + '</span>' +
			(d.note ? '<span class="tools-gantt__tooltip-note">' + d.note + '</span>' : '')
		);
		tooltip.classed('is-visible', true);
		moveTooltip(event);
	}

	function moveTooltip(event) {
		const rootRect = root.getBoundingClientRect();
		tooltip
			.style('left', (event.clientX - rootRect.left + 16) + 'px')
			.style('top', (event.clientY - rootRect.top + 16) + 'px');
	}

	function hideTooltip() {
		tooltip.classed('is-visible', false);
	}

	// ---- Year range filter — tools outside the selected window are removed
	// from the layout entirely (not just hidden), so rows below them close
	// the gap. Wired up by the range slider below. ----
	let yearRange = [minDate.getFullYear(), today.getFullYear()];
	function visibleTools(track) {
		const rangeStart = new Date(yearRange[0], 0, 1);
		const rangeEnd   = new Date(yearRange[1], 11, 31);
		return track.tools.filter(t => t.endDate >= rangeStart && t.startDate <= rangeEnd);
	}

	// ---- Bars + gridlines (drawn per current scale; row count reflects the
	// active year-range filter, so tracks resize as rows drop out) ----
	let currentX = null;
	function render(x) {
		currentX = x;
		rulerTrack.selectAll('*').remove();

		const years = x.ticks(d3.timeYear.every(1));
		rulerTrack.selectAll('.tools-gantt__year')
			.data(years)
			.enter()
			.append('div')
			.attr('class', 'tools-gantt__year')
			.style('left', d => Math.round(x(d)) + 'px')
			.text(d => d3.timeFormat('%Y')(d));

		trackRows.each(function (track) {
			const row   = d3.select(this);
			const lanes = row.select('.tools-gantt__track-lanes');
			const vis   = visibleTools(track);
			const trackHeight = Math.max(1, vis.length) * LANE_HEIGHT;

			row.style('height', trackHeight + 'px');
			row.select('.tools-gantt__track-label').style('height', trackHeight + 'px');
			lanes.style('height', trackHeight + 'px');

			lanes.selectAll('.tools-gantt__gridline')
				.data(years)
				.join('div')
				.attr('class', 'tools-gantt__gridline')
				.style('left', d => Math.round(x(d)) + 'px');

			const bars = lanes.selectAll('.tools-gantt__bar')
				.data(vis, d => d.id)
				.join(
					enter => enter.append(d => document.createElement(d.url ? 'a' : 'div'))
						.attr('class', d => 'tools-gantt__bar' + (d.status === 'current' ? ' is-current' : '') + (d.status === 'sunset' ? ' is-sunset' : ''))
						.attr('href', d => d.url || null)
						.attr('target', d => d.url ? '_blank' : null)
						.attr('rel', d => d.url ? 'noopener noreferrer' : null)
						.style('opacity', 0)
						.on('mouseenter', showTooltip)
						.on('mousemove', moveTooltip)
						.on('mouseleave', hideTooltip)
						.call(sel => sel.append('span').attr('class', 'tools-gantt__bar-sunset'))
						.call(sel => sel.append('span').attr('class', 'tools-gantt__bar-label').text(d => d.name))
						.call(sel => sel.transition().duration(150).style('opacity', 1)),
					update => update,
					exit => exit.transition().duration(120).style('opacity', 0).remove()
				)
				.style('left', d => Math.round(x(d.endDate)) + 'px')
				.style('width', d => Math.max(34, Math.round(x(d.startDate) - x(d.endDate))) + 'px')
				.style('top', (d, i) => (i * LANE_HEIGHT) + 'px');

			// Sunset overlay: the recent-side slice of the bar from the
			// sunset date up to its end/today — a tool kept only for legacy
			// projects, not adopted for new work.
			bars.select('.tools-gantt__bar-sunset')
				.style('display', d => d.sunsetDate ? '' : 'none')
				.style('width', d => d.sunsetDate ? Math.max(0, Math.round(x(d.sunsetDate) - x(d.endDate))) + 'px' : '0');
		});
	}

	// ---- Row labels "stack" against the left edge of the viewport as you
	// scroll, instead of scrolling out of view with the rest of the bar —
	// clamped so a label never renders past its own bar's right edge. ----
	const scrollNode = scroll.node();
	function updateStickyLabels() {
		const viewLeft = scrollNode.scrollLeft;
		scrollNode.querySelectorAll('.tools-gantt__bar').forEach(bar => {
			const barLeft  = parseFloat(bar.style.left);
			const barWidth = parseFloat(bar.style.width);
			const label    = bar.querySelector('.tools-gantt__bar-label');
			if (!label) return;
			const maxOffset = Math.max(0, barWidth - label.offsetWidth - 4);
			const offset    = Math.min(maxOffset, Math.max(0, viewLeft - barLeft));
			label.style.transform = offset ? 'translateX(' + Math.round(offset) + 'px)' : '';
		});
	}
	scroll.on('scroll', updateStickyLabels);

	function applyYearFilter() {
		render(currentX);
		updateStickyLabels();
	}

	render(baseX);
	updateStickyLabels();

	// ---- Zoom (ctrl/cmd + wheel only — plain scroll stays native) ----
	const zoom = d3.zoom()
		.scaleExtent([0.4, 8])
		.filter(event => event.type !== 'wheel' || event.ctrlKey || event.metaKey)
		.on('zoom', event => {
			const newX = event.transform.rescaleX(baseX);
			const newWidth = Math.max(baseWidth, newX.range()[1] - newX.range()[0]);
			rulerTrack.style('width', newWidth + 'px');
			lanesArea.style('width', newWidth + 'px');
			render(newX);
			updateStickyLabels();
		});

	scroll.call(zoom).on('dblclick.zoom', null);

	// ---- Year range slider ----
	// Reversed to match the chart: most recent year on the left (0%),
	// oldest year on the right (100%).
	const sliderRoot = document.getElementById('tools-year-slider');
	if (sliderRoot) {
		const minYear = minDate.getFullYear();
		const maxYear = today.getFullYear();
		let selMin = minYear;
		let selMax = maxYear;

		const wrap = d3.select(sliderRoot).append('div').attr('class', 'tools-year-slider__inner');
		const labels = wrap.append('div').attr('class', 'tools-year-slider__labels');
		const labelRecent = labels.append('span');
		const labelOld = labels.append('span');
		const trackWrap = wrap.append('div').attr('class', 'tools-year-slider__track');
		trackWrap.append('div').attr('class', 'tools-year-slider__rail');
		const rangeEl = trackWrap.append('div').attr('class', 'tools-year-slider__range');
		const handleMin = trackWrap.append('div')
			.attr('class', 'tools-year-slider__handle')
			.attr('tabindex', 0).attr('role', 'slider').attr('aria-label', 'Oldest year');
		const handleMax = trackWrap.append('div')
			.attr('class', 'tools-year-slider__handle')
			.attr('tabindex', 0).attr('role', 'slider').attr('aria-label', 'Most recent year');

		const ticks = wrap.append('div').attr('class', 'tools-year-slider__ticks');
		const yearSpan = maxYear - minYear;
		d3.range(maxYear, minYear - 1, -1).forEach(y => {
			if (yearSpan <= 16 || y === minYear || y === maxYear || y % 5 === 0) {
				ticks.append('span').attr('class', 'tools-year-slider__tick').text(y);
			}
		});

		// Reversed: recent (maxYear) -> 0%, oldest (minYear) -> 100%.
		function yearToPct(y) {
			return maxYear === minYear ? 0 : (maxYear - y) / (maxYear - minYear) * 100;
		}
		function pctToYear(pct) {
			return Math.round(maxYear - pct * (maxYear - minYear));
		}

		function updateSlider() {
			labelRecent.html('<strong>' + selMax + '</strong> —');
			labelOld.html('<strong>' + selMin + '</strong>');
			handleMax.style('left', yearToPct(selMax) + '%');
			handleMin.style('left', yearToPct(selMin) + '%');
			rangeEl.style('left', yearToPct(selMax) + '%').style('right', (100 - yearToPct(selMin)) + '%');
			yearRange = [selMin, selMax];
			applyYearFilter();
		}

		function dragHandler(isMin) {
			return d3.drag()
				.on('start', function () { this.focus(); })
				.on('drag', event => {
					const rect = trackWrap.node().getBoundingClientRect();
					const pct  = Math.max(0, Math.min(1, (event.sourceEvent.clientX - rect.left) / rect.width));
					const year = pctToYear(pct);
					if (isMin) {
						selMin = Math.min(year, selMax);
					} else {
						selMax = Math.max(year, selMin);
					}
					updateSlider();
				});
		}
		handleMin.call(dragHandler(true));
		handleMax.call(dragHandler(false));

		// Arrow keys follow the visual (reversed) direction: Right/Up moves the
		// handle rightward on screen, i.e. toward older years, and vice versa.
		function keyHandler(isMin) {
			return event => {
				let step = 0;
				if (event.key === 'ArrowLeft' || event.key === 'ArrowDown')  step = 1;
				if (event.key === 'ArrowRight' || event.key === 'ArrowUp')   step = -1;
				if (!step) return;
				event.preventDefault();
				if (isMin) {
					selMin = Math.max(minYear, Math.min(selMax, selMin + step));
				} else {
					selMax = Math.min(maxYear, Math.max(selMin, selMax + step));
				}
				updateSlider();
			};
		}
		handleMin.on('keydown', keyHandler(true));
		handleMax.on('keydown', keyHandler(false));

		updateSlider();
	}

	// ---- Filter pills (multi-select — several categories can be active at once) ----
	const pills = document.querySelectorAll('.tools-filter-pill');
	const allPill = document.querySelector('.tools-filter-pill[data-tools-filter="all"]');
	const active = new Set();

	function applyFilter() {
		const showAll = active.size === 0;
		allPill.classList.toggle('is-active', showAll);
		pills.forEach(p => {
			if (p !== allPill) p.classList.toggle('is-active', active.has(p.dataset.toolsFilter));
		});

		trackRows.filter(d => showAll || active.has(d.slug)).style('display', '');
		trackRows.transition().duration(200).style('opacity', d => (showAll || active.has(d.slug)) ? 1 : 0)
			.on('end', function (d) {
				const show = showAll || active.has(d.slug);
				this.style.display = show ? '' : 'none';
			});
	}

	pills.forEach(pill => {
		pill.addEventListener('click', () => {
			const filter = pill.dataset.toolsFilter;
			if (filter === 'all') {
				active.clear();
			} else if (active.has(filter)) {
				active.delete(filter);
			} else {
				active.add(filter);
			}
			applyFilter();
		});
	});
})();
