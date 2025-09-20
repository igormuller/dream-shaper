import api from "./api";

export interface Course {
  id: number;
  name: string;
  description: string;
}

export async function getCourses(page = 1) {
  const { data } = await api.get(`/courses?page=${page}`);
  return data;
}

export async function getCourseById(id: number) {
  const { data } = await api.get(`/courses/${id}`);
  return data;
}

export async function createCourse(course: Omit<Course, "id">) {
  const { data } = await api.post("/courses", course);
  return data;
}

export async function updateCourse(id: number, course: Partial<Course>) {
  const { data } = await api.put(`/courses/${id}`, course);
  return data;
}

export async function deleteCourse(id: number) {
  await api.delete(`/courses/${id}`);
}

export async function courseStudents(id: number) {
  const { data } = await api.get(`/courses/${id}/students`);
  return data;
}

export async function courseEnrollment(courseId: number, studentId: number) {
  const { data } = await api.get(`/courses/${courseId}/enroll/${studentId}`);
  return data;
}