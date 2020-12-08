const  routes = [
    { path: '/', component: require('../components/socialV/NewsFeed/NewsFeed').default},
    { path: '/newsfeed', component: require('../components/socialV/NewsFeed/NewsFeed').default},
    { path: '/settings', component: require('../components/socialV/Userinfo/accountSetting').default },
    { path: '*', component: require('../components/socialV/errorPage/404').default},

];


export  default  routes
