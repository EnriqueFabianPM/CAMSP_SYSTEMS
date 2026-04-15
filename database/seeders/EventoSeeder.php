<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evento;

class EventoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventos = [
            [
                "titulo" => "💻 Muestra de Informática",
                "fecha" => "2025-03-26",
                "descripcion" => "Cierre de proyectos: Presentación y venta de productos en nuestros puestos de comida.",
                "link" => "https://www.facebook.com/camlaboralsanpedro",
                "imagenes" => [
                    "Imagenes/CAM Evento0A.jpeg",
                    "Imagenes/CAM Evento0B.jpeg",
                    "Imagenes/CAM Evento0C.jpeg",
                    "Imagenes/CAM Evento0D.jpeg"
                ]
            ],
            [
                "titulo" => "🇲🇽 Asamblea Cívica de Marzo",
                "fecha" => "2025-03-24",
                "descripcion" => "Celebración de las efemérides del mes y fomento a nuestros valores cívicos.",
                "link" => "https://www.facebook.com/media/set?vanity=camlaboralsanpedro&set=a.4528365904044568",
                "imagenes" => [
                    "Imagenes/CAM Evento1A.jpg",
                    "Imagenes/CAM Evento1B.jpg",
                    "Imagenes/CAM Evento1C.jpg",
                    "Imagenes/CAM Evento1D.jpg"
                ]
            ],
            [
                "titulo" => "❤️ Asamblea de la Amistad",
                "fecha" => "2025-02-27",
                "descripcion" => "Conmemoración de las fechas históricas de febrero y convivencia escolar.",
                "link" => "https://www.facebook.com/media/set/?vanity=camlaboralsanpedro&set=a.4499212796959879",
                "imagenes" => [
                    "Imagenes/CAM Evento2A.jpg",
                    "Imagenes/CAM Evento2B.jpg",
                    "Imagenes/CAM Evento2C.jpg",
                    "Imagenes/CAM Evento2D.jpg"
                ]
            ],
            [
                "titulo" => "👨‍👩‍👧‍👦 Encuentro de Convivencia Familiar",
                "fecha" => "2025-02-04",
                "descripcion" => "Reunión especial con padres de familia para fortalecer los lazos con la comunidad educativa.",
                "link" => "https://www.facebook.com/media/set?vanity=camlaboralsanpedro&set=a.4470606916487134",
                "imagenes" => [
                    "Imagenes/CAM Evento3A.jpg",
                    "Imagenes/CAM Evento3B.jpg",
                    "Imagenes/CAM Evento3C.jpg",
                    "Imagenes/CAM Evento3D.jpg"
                ]
            ],
            [
                "titulo" => "💼 Feria de Inclusión Laboral",
                "fecha" => "2025-12-03",
                "descripcion" => "Exposición y vinculación laboral coordinada por la Dirección de Educación Especial.",
                "link" => "https://www.facebook.com/media/set/?vanity=camlaboralsanpedro&set=a.4398542707026889",
                "imagenes" => [
                    "Imagenes/CAM Evento4A.jpg",
                    "Imagenes/CAM Evento4B.jpg",
                    "Imagenes/CAM Evento4C.jpg",
                    "Imagenes/CAM Evento4D.jpg"
                ]
            ],
            [
                "titulo" => "🎄 Bazar y Posada Navideña",
                "fecha" => "2025-12-02",
                "descripcion" => "Celebración de fin de año y exposición de trabajos manuales en las aulas.",
                "link" => "https://www.facebook.com/media/set/?vanity=camlaboralsanpedro&set=a.4397318363815990",
                "imagenes" => [
                    "Imagenes/CAM Evento5A.jpg",
                    "Imagenes/CAM Evento5B.jpg",
                    "Imagenes/CAM Evento5C.jpg",
                    "Imagenes/CAM Evento5D.jpg"
                ]
            ],
            [
                "titulo" => "🧠 Taller de Bienestar Emocional",
                "fecha" => "2025-11-26",
                "descripcion" => "Sesión formativa para padres de familia enfocada en la salud mental y apoyo emocional.",
                "link" => "https://www.facebook.com/media/set/?vanity=camlaboralsanpedro&set=a.4390200671194426",
                "imagenes" => [
                    "Imagenes/CAM Evento6A.jpg",
                    "Imagenes/CAM Evento6B.jpg",
                    "Imagenes/CAM Evento6C.jpg",
                    "Imagenes/CAM Evento6D.jpg"
                ]
            ],
            [
                "titulo" => "💀 Tradicional Altar de Muertos",
                "fecha" => "2017-11-01",
                "descripcion" => "Homenaje y preservación de nuestras tradiciones mexicanas en la comunidad CAM.",
                "link" => "https://www.facebook.com/media/set/?vanity=camlaboralsanpedro&set=a.2039553959592454",
                "imagenes" => [
                    "Imagenes/CAM Evento7A.jpg",
                    "Imagenes/CAM Evento7B.jpg",
                    "Imagenes/CAM Evento7C.jpg",
                    "Imagenes/CAM Evento7D.jpg"
                ]
            ],
            [
                "titulo" => "🌱 Charla: Afectividad y Sexualidad",
                "fecha" => "2025-06-23",
                "descripcion" => "Conferencia del CDV para padres sobre el desarrollo integral y afectivo de los estudiantes.",
                "link" => "https://www.facebook.com/camlaboralsanpedro/posts/pfbid0TCRjC6gNvX6G2VhfeKJPeoVzwWbNgFwsto7HdZkWQqTzHqbsU9kzRS5ArTBYeatjl",
                "imagenes" => [
                    "Imagenes/CAM Evento8A.jpg",
                    "Imagenes/CAM Evento8B.jpg",
                    "Imagenes/CAM Evento8C.jpg",
                    "Imagenes/CAM Evento8D.jpg"
                ]
            ],
            [
                "titulo" => "🎉 Gran Festejo del Estudiante",
                "fecha" => "2025-05-24",
                "descripcion" => "Día de recreación y convivencia para celebrar el esfuerzo de nuestros alumnos.",
                "link" => "https://www.facebook.com/media/set/?vanity=camlaboralsanpedro&set=a.4164521263762369",
                "imagenes" => [
                    "Imagenes/CAM Evento9A.jpg",
                    "Imagenes/CAM Evento9B.jpg",
                    "Imagenes/CAM Evento9C.jpg",
                    "Imagenes/CAM Evento9D.jpg"
                ]
            ],
        ];

        foreach ($eventos as $evento) {
            Evento::create($evento);
        }
    }
}