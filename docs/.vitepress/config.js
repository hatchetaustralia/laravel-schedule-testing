import { defineConfig } from "vitepress"

export default defineConfig({
    title: 'Laravel Schedule Testing',
    titleTemplate: 'Hatchet Laravel Schedule Testing - :title',
    description: 'A lightweight package for testing Laravel schedules.',

    base: '/laravel-schedule-testing/',

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
                        { text: 'runsInMaintenanceMode', link: '/assertions/#runsinmaintenancemode' },
                        { text: 'canOverlap', link: '/assertions/#canoverlap' },
                        { text: 'cannotOverlap', link: '/assertions/#cannotoverlap' },
                    ]
                },
                {
                    text: 'Schedule Frequency Options',
                    link: '/assertions/schedule-frequency-options',
                    collapsed: true,
                    items: [
                        { text: 'runsAt', link: '/assertions/schedule-frequency-options#runsat'},
                        { text: 'runsEveryMinute', link: '/assertions/schedule-frequency-options#runseveryminute'},
                        { text: 'runsEveryTwoMinutes', link: '/assertions/schedule-frequency-options#runseverytwominutes'},
                        { text: 'runsEveryThreeMinutes', link: '/assertions/schedule-frequency-options#runseverythreeminutes'},
                        { text: 'runsEveryFourMinutes', link: '/assertions/schedule-frequency-options#runseveryfourminutes'},
                        { text: 'runsEveryFiveMinutes', link: '/assertions/schedule-frequency-options#runseveryfiveminutes'},
                        { text: 'runsEveryTenMinutes', link: '/assertions/schedule-frequency-options#runseverytenminutes'},
                        { text: 'runsEveryFifteenMinutes', link: '/assertions/schedule-frequency-options#runseveryfifteenminutes'},
                        { text: 'runsEveryThirtyMinutes', link: '/assertions/schedule-frequency-options#runseverythirtyminutes'},
                        { text: 'runsHourly', link: '/assertions/schedule-frequency-options#runshourly'},
                        { text: 'runsHourlyAt', link: '/assertions/schedule-frequency-options#runshourlyat'},
                        { text: 'runsEveryOddHour', link: '/assertions/schedule-frequency-options#runseveryoddhour'},
                        { text: 'runsEveryTwoHours', link: '/assertions/schedule-frequency-options#runseverytwohours'},
                        { text: 'runsEveryThreeHours', link: '/assertions/schedule-frequency-options#runseverythreehours'},
                        { text: 'runsEveryFourHours', link: '/assertions/schedule-frequency-options#runseveryfourhours'},
                        { text: 'runsEverySixHours', link: '/assertions/schedule-frequency-options#runseverysixhours'},
                        { text: 'runsDaily', link: '/assertions/schedule-frequency-options#runsdaily'},
                        { text: 'runsDailyAt', link: '/assertions/schedule-frequency-options#runsdailyat'},
                        { text: 'runsTwiceDaily', link: '/assertions/schedule-frequency-options#runstwicedaily'},
                        { text: 'runsTwiceDailyAt', link: '/assertions/schedule-frequency-options#runstwicedailyat'},
                        { text: 'runsWeekly', link: '/assertions/schedule-frequency-options#runsweekly'},
                        { text: 'runsWeeklyOn', link: '/assertions/schedule-frequency-options#runsweeklyon'},
                        { text: 'runsMonthly', link: '/assertions/schedule-frequency-options#runsmonthly'},
                        { text: 'runsMonthlyOn', link: '/assertions/schedule-frequency-options#runsmonthlyon'},
                        { text: 'runsTwiceMonthly', link: '/assertions/schedule-frequency-options#runstwicemonthly'},
                        { text: 'runsLastDayOfMonth', link: '/assertions/schedule-frequency-options#runslastdayofmonth'},
                        { text: 'runsQuarterly', link: '/assertions/schedule-frequency-options#runsquarterly'},
                        { text: 'runsQuarterlyOn', link: '/assertions/schedule-frequency-options#runsquarterlyon'},
                        { text: 'runsYearly', link: '/assertions/schedule-frequency-options#runsyearly'},
                        { text: 'runsYearlyOn', link: '/assertions/schedule-frequency-options#runsyearlyon'},
                        { text: 'runsOnWeekdays', link: '/assertions/schedule-frequency-options#runsonweekdays'},
                        { text: 'runsOnWeekends', link: '/assertions/schedule-frequency-options#runsonweekends'},
                        { text: 'runsOnMondays', link: '/assertions/schedule-frequency-options#runsonmondays'},
                        { text: 'runsOnTuesdays', link: '/assertions/schedule-frequency-options#runsontuesdays'},
                        { text: 'runsOnWednesdays', link: '/assertions/schedule-frequency-options#runsonwednesdays'},
                        { text: 'runsOnThursdays', link: '/assertions/schedule-frequency-options#runsonthursdays'},
                        { text: 'runsOnFridays', link: '/assertions/schedule-frequency-options#runsonfridays'},
                        { text: 'runsOnSaturdays', link: '/assertions/schedule-frequency-options#runsonsaturdays'},
                        { text: 'runsOnSundays', link: '/assertions/schedule-frequency-options#runsonsundays'},
                        { text: 'runsOnDays', link: '/assertions/schedule-frequency-options#runsondays'},
                    ]
                },
            ]
        },
    ]
}
