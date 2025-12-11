# CS Strike - Counter Strike Inspired Game

A fast-paced, tactical shooting game inspired by Counter Strike mechanics, built for the web as a single-page playable game.

## Game Overview

CS Strike is a tactical top-down shooting game that brings CS (Counter Strike) mechanics to a browser-based experience. Eliminate all enemy terrorists to win the round and earn money for the next round.

## Features

### Core Mechanics
- **Round-Based Gameplay**: Each round presents a new challenge with increasing difficulty
- **Team System**: Play as Terrorists (T) or Counter-Terrorists (CT)
- **Economy System**: Earn money from kills ($300 per enemy) and wins ($1400 bonus)
- **Weapon System**: M4A1 primary weapon with ammo management
- **Enemy AI**: Smart AI opponents that patrol, chase, and shoot at the player

### Game Elements
- **Health System**: Start with 100 HP, manage damage from enemy fire
- **Ammunition**: 30 rounds in magazine, 120 reserve ammo
- **Reload Mechanic**: Press R to reload (takes time)
- **Score Tracking**: Track kills, deaths, and money earned
- **Visual Feedback**: Damage indicators, hit animations, and status messages

## How to Play

### Getting Started
1. Open the game via the link on the homepage or navigate to `/game`
2. Read the instructions displayed in the top-right corner
3. The game automatically starts with 3+ enemies

### Controls

| Action | Control |
|--------|---------|
| Move Forward | W or ↑ Arrow |
| Move Backward | S or ↓ Arrow |
| Move Left | A or ← Arrow |
| Move Right | D or → Arrow |
| Aim/Look | Mouse Movement |
| Shoot | Left Click (Mouse) |
| Jump | Space Bar |
| Reload | R Key |

### Objective

**Win Condition**: Eliminate all enemies in the arena
**Lose Condition**: Health reaches 0

## Game Mechanics

### Economy System
- **Enemy Kill**: +$300
- **Round Win**: +$1400 bonus
- **Starting Money**: $2,400 per round
- **Minimum Money**: Resets to $1,400 if balance drops too low

### Difficulty Progression
- Round 1: 4 enemies
- Round 2: 5 enemies
- Round 3+: 6+ enemies (increases each round)

### Enemy Behavior
- **Patrol**: Move randomly around the arena
- **Detect**: Chase player when within 300 units
- **Engage**: Shoot at player when in range (600 units)
- **Accuracy**: Enemies have spread/inaccuracy like the player

### Weapon Stats

**M4A1 Rifle**
- Damage per hit: 25
- Fire rate: 600ms between shots
- Magazine capacity: 30 rounds
- Reload time: 3 seconds
- Effective range: Unlimited (but with spread)

## User Interface

### Top HUD Bar
Shows real-time game information:
- **Health**: Current health points (green)
- **Ammo**: Magazine rounds / Reserve ammo (orange)
- **Weapon**: Currently equipped weapon
- **Round**: Current round number
- **Team**: Your team (T/Terrorists or CT/Counter-Terrorists)
- **Kills**: Total enemies eliminated
- **Deaths**: Times you've been eliminated this session
- **Money**: Current balance for purchases

### Chat/Event Messages
- Displayed in bottom-left corner
- Shows game events like kills, reloads, and server announcements
- Auto-disappears after 3 seconds

### Status Display
- Centered message showing round start/end information
- Victory/Defeat announcements

### Game Over Screen
- Shows round results (Won/Lost)
- Displays final stats (kills, deaths, money)
- Button to continue to next round

## Game Design Philosophy

CS Strike captures the essence of Counter Strike with:
- **Tactical gameplay**: Think about positioning and ammo management
- **Skill-based combat**: Accuracy and reaction time matter
- **Economic system**: Manage your money wisely
- **Team dynamics**: Visual distinction between teams
- **Instant feedback**: See your hits and damage immediately

## Technical Stack

- **Frontend**: HTML5, CSS3, JavaScript (ES6+)
- **Graphics**: Canvas 2D API
- **Architecture**: Object-Oriented with Entity, Player, and Enemy classes
- **Physics**: Simple velocity-based movement and collision detection
- **Responsive Design**: Adapts to different screen sizes

## Tips for Success

1. **Stay mobile**: Keep moving to avoid enemy fire
2. **Manage ammo**: Reload before empty to minimize downtime
3. **Use the environment**: The arena boundaries can help shield you
4. **Focus fire**: Target one enemy at a time for cleaner kills
5. **Listen to audio cues**: Pay attention to the chat messages for tactical info
6. **Learn enemy patterns**: Enemies patrol predictably when not engaged

## Known Limitations

- Single-player mode against AI only
- Fixed top-down perspective
- Simple graphics (intentionally minimalist)
- No complex level design (single arena)
- AI uses simplified pathfinding

## Future Enhancement Ideas

- Multiple weapon types with different stats
- Power-ups and special abilities
- Procedurally generated arenas
- Leaderboard and high scores
- Multiplayer support
- Mobile touch controls
- Sound effects and music
- More sophisticated enemy AI

## Credits

Built as a Counter Strike-inspired game demonstrating:
- Game development fundamentals
- Object-oriented programming in JavaScript
- Real-time rendering and game loops
- Event-driven architecture
- Responsive game design

Enjoy the game, and may your aim be true!
