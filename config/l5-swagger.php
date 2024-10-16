<?php

return [
    'default' => env('L5_SWAGGER_DEFAULT', 'default'),
    'documentations' => [
        'default' => [
            'api' => [
                // Ajuste o título da sua API aqui
                'title' => env('L5_SWAGGER_API_TITLE', 'Documentação da API de Vídeos'),
            ],

            'routes' => [
                /*
                 * Rota para acessar a interface de documentação da API
                 */
                'api' => env('L5_SWAGGER_API_ROUTE', 'api/documentation'),
            ],

            'paths' => [
                /*
                 * Caminho onde a documentação gerada será armazenada
                 */
                'docs' => env('L5_SWAGGER_DOCS_PATH', storage_path('api-docs')),

                /*
                 * Caminho para escanear anotações (controladores, modelos, etc.)
                 * Aqui, estamos apontando diretamente para a pasta dos controladores
                 * onde as anotações Swagger estarão presentes.
                 */
                'annotations' => env('L5_SWAGGER_ANNOTATIONS_PATH', base_path('app/Http/Controllers')),

                /*
                 * Caminho para os assets necessários pelo Swagger UI (JS, CSS, imagens)
                 */
                'assets' => env('L5_SWAGGER_ASSETS_PATH', base_path('vendor/swagger-api/swagger-ui/dist')),

                /*
                 * Diretório das views personalizadas, se houver
                 */
                'views' => env('L5_SWAGGER_VIEWS_PATH', base_path('resources/views/vendor/l5-swagger')),
            ],
        ],
    ],
];