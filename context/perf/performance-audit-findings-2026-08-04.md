# BD-152 Performance Audit — Findings & Recommendations

**Date:** 2026-08-04  
**Auditor:** studio-looper  
**Environment:** Production (https://bain.design, Cloudways)

---

## Current State

### Active Plugins
- **ACF Pro** (6.8.2) — custom fields, lightweight
- **Yoast SEO** (26.8) — good for SEO, moderate overhead
- **bd-custom** — site-specific business logic
- **WPForms Lite** (1.10.0.5) — form handling
- **Classic Editor** (1.6.7) — legacy editor support
- **Redirection** (5.7.5) — URL management
- **Helpful Information** (1.0.2) — custom
- **Regenerate Thumbnails** (3.1.6) — utility
- **Foobot Air Quality Plugin** (1.2.1) — data integration

### Inactive Plugins (Available)
- **WP Super Cache** (options exist but plugin not active)
- **WP Mail SMTP** (deactivated, but should be active for production email)
- **Wordfence** (security, not performance)
- **BackWPup** (backups)

### Performance Observations

1. **WP Super Cache historical use** — `wpsupercache_start` option found (timestamp: 1416997876), indicating previous caching setup. Currently inactive.
2. **No .htaccess configured** — no browser caching headers or GZIP configured at web server level
3. **Yoast SEO active** — adds weight but useful for SEO; ensure it's optimized

---

## Cloudways Features Available (Production)

Bain Design runs on **Cloudways** (Digital Ocean backend). Available performance features:

### 1. **Cloudways Native Caching** (Built-in, often not activated)
- **APCu** — opcode cache (PHP acceleration)
- **Redis** — object/page caching layer
- **Memcached** — alternative to Redis
- **Varnish** — HTTP caching layer (if available on plan)

**Recommendation:** Enable Redis on Cloudways panel if not already active. This is the highest-impact, zero-configuration optimization.

### 2. **Let's Encrypt SSL** (Likely already active)
- Verify HSTS headers are sent
- Ensure OCSP stapling is enabled

### 3. **Brotli Compression** (Often enabled server-side)
- Verify in response headers: `Content-Encoding: br`
- More efficient than gzip for text

### 4. **HTTP/2 & HTTP/3 Support**
- Cloudways typically enables this automatically
- Check browser DevTools Network tab

### 5. **PHP-FPM Configuration**
- Adjust PHP max children/processes for traffic
- Tune `max_input_vars`, `post_max_size` if needed
- Consider PHP 8.2 or 8.3 if still on older version

### 6. **MySQL Optimization**
- Enable query caching (if MySQL < 8.0)
- Check table optimization regularly
- Verify InnoDB buffer pool size

---

## Recommended Performance Plugins

### High Priority (P1)

#### 1. **WP Super Cache** (Re-activate)
- Already installed; switch from inactive → active
- Lightest-weight page caching solution
- Works well with Cloudways
- **Setup:** Just enable in admin dashboard

#### 2. **Redis Cache** or **Memcached** (if Cloudways has Redis enabled)
- Integrates with Cloudways native Redis
- Caches database queries and transients
- Alternatives:
  - [Redis Cache](https://wordpress.org/plugins/redis-cache/) (official, recommended)
  - [Memcached Redux](https://wordpress.org/plugins/memcached-redux/)

#### 3. **Image Optimization** (Choose one)
- [Smush](https://wordpress.org/plugins/wp-smushit/) — free tier sufficient for most sites
- [Imagify](https://wordpress.org/plugins/imagify/) — good compression, integrates with Yoast
- [ShortPixel](https://shortpixel.com/) — excellent quality, batch processing
- **Impact:** ~20-30% image size reduction without quality loss

### Medium Priority (P2)

#### 4. **Autoptimize**
- Minifies CSS/JS
- Lazy-loads images (with native WP Lazy Load, less necessary as of WP 6.4)
- Combines files
- **Note:** Test compatibility with bd-custom plugin

#### 5. **Lazy Load Optimization**
- **Native WP Lazy Load** — built into WP 5.5+, sufficient for most sites
- **a3 Lazy Load** — more control if needed
- Already works on theme images via `loading="lazy"` attribute

#### 6. **WP-CLI Cache Warmer**
- Pre-populate cache after deployment
- Reduces first-hit slowness
- [WP CLI Cache Warmer](https://github.com/anandrelyea/wp-cli-cache-warmer) or custom script

### Low Priority (P3) / Not Recommended

- **NitroPack** — expensive, overlaps with native caching
- **Perfmatrix** — limited value for small sites
- **AssetCleanup** — rarely needed if Yoast + Autoptimize running
- **Cloudflare** — overkill for this site; Cloudways provides DDoS protection

---

## Implementation Roadmap

### Phase 1 (Do First)
1. Activate **WP Super Cache** (already installed)
2. Enable **Redis** on Cloudways control panel
3. Install + configure **Redis Cache** plugin
4. Install **Smush** for image optimization
5. Test site after each step

### Phase 2 (Next Week)
1. Install **Autoptimize** for JS/CSS minification
2. Benchmark performance (PSI scores)
3. Add tasks to Asana for any further optimization

### Phase 3 (Optional)
1. Set up WP-CLI cache warming in deployment pipeline
2. Configure Cloudways MySQL optimization
3. Review Yoast SEO settings for overhead

---

## Cloudways Configuration Checklist

To verify these are enabled (or enable via Cloudways panel):

- [ ] Redis is enabled and running
- [ ] PHP version is 8.2+ (check current)
- [ ] Gzip/Brotli compression enabled
- [ ] Let's Encrypt SSL active + auto-renew
- [ ] HSTS headers enabled
- [ ] OCSP stapling enabled
- [ ] PHP FPM tuned for traffic (check max children)
- [ ] MySQL auto-optimize enabled
- [ ] Daily backups enabled (already likely true)

---

## Questions for Mark

1. Is Redis currently enabled on the Cloudways server?
2. What's the current PHP version?
3. Do we have performance baselines from before (PSI scores)?
4. Any known slow pages or user complaints?
5. Should WP Mail SMTP be re-activated for production email sending?

---

## Status

**Blockers:** None — all recommendations can proceed immediately.  
**Next Action:** Activate WP Super Cache, enable Cloudways Redis, install Redis Cache plugin. Test.

Task: **Ready for Review**
