<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        $courses = [
            'Introdução à Programação',
            'Algoritmos e Estruturas de Dados',
            'Desenvolvimento Web com PHP e Laravel',
            'JavaScript Avançado e Vue.js',
            'React.js para Iniciantes',
            'Banco de Dados MySQL e PostgreSQL',
            'NoSQL com MongoDB',
            'DevOps com Docker e Kubernetes',
            'Introdução à Ciência de Dados com Python',
            'Machine Learning Básico com Scikit-Learn',
            'Desenvolvimento Mobile com React Native',
            'APIs RESTful com Node.js',
            'TypeScript para Projetos Escaláveis',
            'Segurança em Aplicações Web',
            'Arquitetura de Microsserviços'
        ];

        return [
            'name'           => $this->faker->unique()->randomElement($courses),
            'description'    => $this->faker->paragraph(2),
            'duration_hours' => $this->faker->numberBetween(20, 200),
        ];
    }
}
