import api from "./api";

export interface Student {
  id: number;
  name: string;
  email: string;
  cpf: string;
}

export async function getStudents(page = 1, courseId?: number) {
  const { data } = await api.get(`/students?page=${page}`);
  return data;
}

export async function listStudentsByCourse(courseId?: number) {
  const { data } = await api.get(`/students-by-course/${courseId}`);
  return data;
}

export async function getStudentById(id: number) {
  const { data } = await api.get(`/students/${id}`);
  return data;
}

export async function createStudent(student: Omit<Student, "id">) {
  const { data } = await api.post("/students", student);
  return data;
}

export async function updateStudent(id: number, student: Partial<Student>) {
  const { data } = await api.put(`/students/${id}`, student);
  return data;
}

export async function deleteStudent(id: number) {
  await api.delete(`/students/${id}`);
}

export async function studentCourses(id: number) {
  const { data } = await api.get(`/students/${id}/courses`);
  return data;
}