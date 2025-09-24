import api from "./api";

export async function getEnrollmentsByMonth() {
  const { data } = await api.get(`/dashboard/enrollments`);
  return data;
}

export async function getEnrollmentsByCourse() {
  const { data } = await api.get(`/dashboard/enrollments-by-course`);
  return data;
}