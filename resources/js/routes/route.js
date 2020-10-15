const  routes = [
    { path: '/', component: require('../components/socialV/NewsFeed/NewsFeed').default},
    { path: '/newsfeed', component: require('../components/socialV/NewsFeed/NewsFeed').default},
    { path: '*', componecomnt: require('../components/socialV/errorPage/404.vue').default},
];


export  default  routes
