# Shelf Climber — Bain Design Mini-Game Spec

## Overview

A playful single-screen platformer where you control **Gala** (the energetic studio cat) to climb shelves, avoid **Salvador** (the lazy one), and collect items. ASCII cats, retro arcade feel, under 60 seconds per round.

## Aesthetic

- Same ASCII cat sprites from footer (`bain_pet`)
- Monospace font, clay/pencil/ink color palette
- Shelves are simple ASCII lines/blocks
- Playful, low-stakes — more about charm than challenge

## Game Loop

**Goal:** Reach the top shelf (or collect 5 items) without touching Salvador.

### Controls

- `A` / `D` or arrow keys: move left/right
- `W` / `Space`: jump (tap for small jump, hold for high jump)
- `Esc`: quit to home

### Mechanics

1. **Gala (player):** Starts on bottom shelf. Has 3 jumps before touching ground. Walks, jumps, falls.
2. **Salvador (AI):** Starts mid-screen. Walks back and forth slowly. Pauses, naps. If Gala gets within 2 shelf-heights, Salvador wakes and walks toward Gala (sluggishly).
3. **Shelves:** 4–5 stacked platforms. Random gaps to force jumping.
4. **Items:** Yarn balls (🧶 or `()~`) scattered on shelves. Collect 5 to win.
5. **Collision:** Touch Salvador → lose a life (3 lives total). Fall off the bottom → lose a life.
6. **Win:** Reach the top shelf or collect 5 items → brief celebratory message, play again.

## Layout

```
        [Gala]           ← Top shelf (goal)
  ═══════════════════════
        [Item]
  ═════════════          ← Shelf 3

            [Salvador]
  ═══════════════════════  ← Shelf 2

[Item]
  ═══════════════════════  ← Bottom (start)
```

## Technical Notes

- **Canvas-based** (vs DOM) for smooth animation, or CSS grid with physics sim
- **Reuse cat frames** from `initPet()` but in a game context (they're just ASCII sprites)
- **Collision detection** via bounding boxes or grid-based (each shelf is a row)
- **Physics:** Simple gravity, jump arc, ground/shelf detection
- **Tone:** "Gala is being very Gala right now. Salvador is not impressed." on win/lose

## Optional Polish

- High score tracker (localStorage)
- Sound effects (beep on collect, thud on jump, alarm if Salvador approaches)
- Difficulty modes (Salvador gets smarter, more items needed, narrower gaps)
- Leaderboard hint: "Post your high score in the footer for eternal glory"

## Implementation Path

1. Create a game container (modal or full-screen overlay)
2. Render ASCII shelves + cats + items
3. Wire up keyboard input for Gala movement
4. Implement gravity/jump physics
5. Add Salvador AI (patrol → chase when close)
6. Collision detection + win/lose conditions
7. Polish: animations, messages, high score save
