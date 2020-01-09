import Vue from 'vue'
import Router from 'vue-router'

// Views
import ViewTopiclist from "../views/TopicList.vue";
import SetupTopic from "../views/TopicSetup.vue";
Vue.use(Router)
export default new Router({
    mode: 'hash', 
    linkActiveClass: 'open active',
    scrollBehavior: () => ({ y: 0 }),
    routes: [
      {
        path: "/views/topic",
        component: ViewTopiclist,
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "/create/topic",
        component: SetupTopic,
        name: "Add New Topic",
        meta: {
          requiresAuth: true
        }
      },
      {
        path: "/modify/topic/:id",
        component: SetupTopic,
        name: "Modify topic",
        meta: {
          requiresAuth: true
        }
      }
    ]
})