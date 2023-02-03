import { defineConfig } from "vitepress"

export default defineConfig({
    title: 'Laravel Schedule Testing',
    description: 'A lightweight package for testing Laravel schedules.',

    base: 'https://hatchetaustralia.github.io/laravel-schedule-testing',

    lastUpdated: true,
    cleanUrls: true,

    head: [
        [ 'meta', { name: 'theme-color', content: '#3c8772' } ],
        [
        'link',
        { rel: 'icon', href: '/favicon-32x32.png', type: 'image/png' }
        ],
        [
        'link',
        { rel: 'preconnect', href: 'https://fonts.googleapis.com' },
        ],
        [
        'link',
        { rel: 'preconnect', href: 'https://fonts.gstatic.com', crossorigin: true },
        ],
        [
        'link',
        { rel: 'stylesheet', href: 'https://fonts.googleapis.com/css2?family=Oswald:wght@300&display=swap' },
        ],
    ],

    themeConfig: {
        // nav: nav(),
        logo: '/hatchet.svg',

        sidebar: {
        '/': sidebar(),
        },

        editLink: {
        pattern: 'https://github.com/hatchetaustralia/laravel-schedule-testing/edit/main/docs/:path',
        text: 'Edit this page on GitHub'
        },

        socialLinks: [
        { icon: 'github', link: 'https://github.com/hatchetaustralia/laravel-schedule-testing' }
        ],

        footer: {
            message: 'Released under the Do Not Harm License.',
            copyright: `Copyright © ${new Date().getFullYear()} <a href="https://hatchet.com.au">Hatchet</a>`
        },
    }
});

function sidebar() {
    return [
    {
        text: 'Introduction',
        collapsed: false,
        items: [
        { text: 'What is Laravel Schedule Testing', link: '/introduction/' },
        { text: 'Getting Started', link: '/introduction/getting-started' },
        ]
    },
    {
        text: 'Assertions',
        collapsed: false,
        items: [
        {
            text: 'Assertions',
            link: '/assertions/',
            collapsed: true,
            items: [
                { text: 'hasOutputOnFailure', link: '/assertions/#hasemailoutputonfailure' },
                { text: 'hasExpression', link: '/assertions/#hasexpression' },
                { text: 'hasTimezone', link: '/assertions/#hastimezone' },
                { text: 'isScheduled', link: '/assertions/#isscheduled' },
                { text: 'isScheduledToRunAt', link: '/assertions/#isscheduledtorunat' },
                { text: 'runsInEnvironment', link: '/assertions/#runsinenvironment' },
            ]
        },
        {
            text: 'Schedule Frequency Options',
            link: '/assertions/schedule-frequency-options',
            collapsed: true,
            items: [
                { text: 'runsEveryMinute', link: '/assertions/schedule-frequency-options#runseveryminute'},
                { text: 'runsEveryTwoMinutes', link: '/assertions/schedule-frequency-options#runseverytwominutes'},
                { text: 'runsEveryThreeMinutes', link: '/assertions/schedule-frequency-options#runseverythreeminutes'},
                { text: 'runsEveryFourMinutes', link: '/assertions/schedule-frequency-options#runseveryfourminutes'},
                { text: 'runsEveryFiveMinutes', link: '/assertions/schedule-frequency-options#runseveryfiveminutes'},
                { text: 'runsEveryTenMinutes', link: '/assertions/schedule-frequency-options#runseverytenminutes'},
                { text: 'runsEveryFifteenMinutes', link: '/assertions/schedule-frequency-options#runseveryfifteenminutes'},
                { text: 'runsEveryThirtyMinutes', link: '/assertions/schedule-frequency-options#runseverythirtyminutes'},
                { text: 'runsHourly', link: '/assertions/schedule-frequency-options#runshourly'},
                { text: 'runsEveryOddHour', link: '/assertions/schedule-frequency-options#runseveryoddhour'},
                { text: 'runsEveryTwoHours', link: '/assertions/schedule-frequency-options#runseverytwohours'},
                { text: 'runsEveryThreeHours', link: '/assertions/schedule-frequency-options#runseverythreehours'},
                { text: 'runsEveryFourHours', link: '/assertions/schedule-frequency-options#runseveryfourhours'},
                { text: 'runsEverySixHours', link: '/assertions/schedule-frequency-options#runseverysixhours'},
                { text: 'runsDaily', link: '/assertions/schedule-frequency-options#runsdaily'},
                { text: 'runsTwiceDaily', link: '/assertions/schedule-frequency-options#runstwicedaily'},
                { text: 'runsWeekly', link: '/assertions/schedule-frequency-options#runsweekly'},
                { text: 'runsMonthly', link: '/assertions/schedule-frequency-options#runsmonthly'},
                { text: 'runsTwiceMonthly', link: '/assertions/schedule-frequency-options#runstwicemonthly'},
                { text: 'runsQuarterly', link: '/assertions/schedule-frequency-options#runsquarterly'},
                { text: 'runsYearly', link: '/assertions/schedule-frequency-options#runsyearly'},
                { text: 'runsOnWeekdays', link: '/assertions/schedule-frequency-options#runsonweekdays'},
                { text: 'runsOnWeekends', link: '/assertions/schedule-frequency-options#runsonweekends'},
                { text: 'runsOnMondays', link: '/assertions/schedule-frequency-options#runsonmondays'},
                { text: 'runsOnTuesdays', link: '/assertions/schedule-frequency-options#runsontuesdays'},
                { text: 'runsOnWednesdays', link: '/assertions/schedule-frequency-options#runsonwednesdays'},
                { text: 'runsOnThursdays', link: '/assertions/schedule-frequency-options#runsonthursdays'},
                { text: 'runsOnFridays', link: '/assertions/schedule-frequency-options#runsonfridays'},
                { text: 'runsOnSaturdays', link: '/assertions/schedule-frequency-options#runsonsaturdays'},
                { text: 'runsOnSundays', link: '/assertions/schedule-frequency-options#runsonsundays'},
            ]
        },
        ]
    },
    ]
}