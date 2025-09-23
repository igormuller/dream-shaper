import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '@/views/HomeView.vue'
import CoursesView from '@/views/Course/CoursesView.vue'
import CourseDetailView from '@/views/Course/CourseDetailView.vue'
import CourseEditView from '@/views/Course/CourseEditView.vue'
import CourseCreateView from '@/views/Course/CourseCreateView.vue'
import StudentsView from '@/views/Student/StudentsView.vue'
import StudentDetailView from '@/views/Student/StudentDetailView.vue'
import StudentEditView from '@/views/Student/StudentEditView.vue'
import StudentCreateView from '@/views/Student/StudentCreateView.vue'
import EnrollmentsEditView from '@/views/Enrollment/EnrollmentsEditView.vue'

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
      name: 'students-list',
      component: StudentsView,
    },
    {
      path: '/students/:id',
      name: 'student-detail',
      component: StudentDetailView,
      props: true,
    },
    {
      path: '/students/:id/edit',
      name: 'student-edit',
      component: StudentEditView,
      props: true,
    },
    {
      path: '/students/create',
      name: 'new-student',
      component: StudentCreateView,
      props: true,
    },
    {
      path: '/enrollments/:id',
      name: 'enrollments-edit',
      component: EnrollmentsEditView,
      props: true,
    },
  ],
})

export default router
