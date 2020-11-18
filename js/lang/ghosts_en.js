function ghostPowers() {
    return {
        'spirit': {
            'name': "Spirit",
            'power': "No power",
            'weakness': "Using incense in the ghost's room will prevent it from attacking for 180 seconds (90 seconds for other ghosts)."
        },
        'wraith': {
            'name': "Wraith",
            'power': "Wraiths do not leave footprints in UV light after walking on a pile of salt. If the target of the Wraith is in the haunted place (and alive), it will teleport 3 meters away from its victim.",
            'weakness': "The Spectre has a Ghost Action Multiplier which will be increased to 50 after walking in salt. It will enter the attack phase less often."
        },
        'phantom': {
            'name': "Phantom",
            'power': "The Phantom remains visible longer than other ghosts. Watching the Phantom will make you lose mental health.",
            'weakness': "Taking a picture of him will make him disappear for a short time. [It doesn't stop an attack]"
        },
        'poltergeist': {
            'name': "Poltergeight",
            'power': "The Poltergeist will throw a lot of objects around him, if a player is near the thrown objects, his mental health will be reduced by 2 times the number of objects thrown.",
            'weakness': "If he is in an empty room, his power is not possible. He will therefore return to a idle phase."
        },
        'banshee': {
            'name': "Banshee",
            'power': "The Banshee can enter the navigation phase. During this phase: If the target, chosen by the Banshee, walks in front of the ghost, an attack phase begins. (Regardless of mental health)",
            'weakness': "If the Banshee's target is outside the haunted place, the Banshee cannot use its power. She will act/attack like a classic ghost. The crucifixes have an efficiency of 5 meters for the Banshees."
        },
        'jinn': {
            'name': "Jinn",
            'power': "Being within 3 metres of a Jinn instantly reduces your mental health by 25%. His ability allows him to move quickly if the target is far away from him, but will return to normal speed once a target is close to him.",
            'weakness': "Cutting off the electricity makes it possible to block the power of the Jinn. The Jinn is easy to spot, it permanently generates an EMF 2 field."
        },
        'mare': {
            'name': "Mare",
            'power': "If the lights in the room where the Mare is located are switched off, its attack multiplier increases by 10.",
            'weakness': "If the lights in the room where the Mare is located are switched on, its attack multiplier is reduced by 10."
        },
        'revenant': {
            'name': "Revenant",
            'power': "When they are chasing a player, they are 2x faster than other ghosts.",
            'weakness': "Revenants move 50% slower than other ghosts when they are not chasing a player."
        },
        'shade': {
            'name': "Shade",
            'power': "The Shade is very discreet, it only reveals itself to single people and there is a chance of entering the attack phase if a person is left alone.",
            'weakness': "If there is more than one player in the ghost room, the attack phase is not initiated."
        },
        'demon': {
            'name': "Demon",
            'power': "The demon is very aggressive, it can enter the attack phase as soon as Mental Health is below 80% on average.",
            'weakness': "Asking a good question at the ouija table will not make you lose your mental health."
        },
        'yurei': {
            'name': "Yurei",
            'power': "The Yurei has a mental health draining force twice as strong as other ghosts. (0.4 of mental health drained)",
            'weakness': "The incense will prevent the Yurei from wandering for 90 seconds."
        },
        'oni': {
            'name': "Oni",
            'power': "The activity of the Oni (actions / hunting) increases if there are people in his room. He will fly objects around his victim. If his victim sees an object being flown, he will become the Oni's target.",
            'weakness': "The increase in Oni's activity also makes it easier to find."
        }
    }
}