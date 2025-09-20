import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import CoursesView from '@/views/Course/CoursesView.vue'
import StudentsView from '@/views/StudentsView.vue'
import EnrollmentsView from '@/views/EnrollmentsView.vue'
import CourseDetailView from '@/views/Course/CourseDetailView.vue'
import CourseEditView from '@/views/Course/CourseEditView.vue'
import CourseCreateView from '@/views/Course/CourseCreateView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/courses',
      name: 'courses-list',
      component: CoursesView,
      // children: [
      //   {
      //     path: ":id",
      //     name: "course-detail",
      //     component: CourseDetailView,
      //     props: true,
      //   },
      // ]
    },
    {
      path: '/courses/:id',
      name: 'course-detail',
      component: CourseDetailView,
      props: true,
    },
    {
      path: '/courses/:id/edit',
      name: 'course-edit',
      component: CourseEditView,
      props: true,
    },
    {
      path: '/courses/create',
      name: 'new-course',
      component: CourseCreateView,
      props: true,
    },
    {
      path: '/students',
      name: 'Students',
      component: StudentsView,
    },
    {
      path: '/enrollments',
      name: 'Enrollments',
      component: EnrollmentsView,
    },
  ],
})

export default router
