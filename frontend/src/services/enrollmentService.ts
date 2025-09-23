import api from "./api";

export interface Enrollment {
  id: number;
  student_id: number;
  course_id: number;
  progress_percentage: number;
  enrollment_date: string;
  completion_date: string | null;
}

export async function getEnrollmentById(id: number) {
  const { data } = await api.get(`/enrollments/${id}`);
  return data;
}

export async function createEnrollment(enroll: Omit<Enrollment, "id">) {
  const { data } = await api.post("/enrollments", enroll);
  return data;
}

export async function updateEnrollment(id: number, enroll: Partial<Enrollment>) {
  const { data } = await api.put(`/enrollments/${id}`, enroll);
  return data;
}