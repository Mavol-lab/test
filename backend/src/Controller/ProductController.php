<?php

namespace App\Controller;

use App\GraphQL\SchemaFactory;
use GraphQL\GraphQL;

class ProductController
{
  public static function handle()
  {
    try {
      $input = json_decode(file_get_contents('php://input'), true);  // Получаем данные из запроса
      $query = $input['query'];
      $variables = $input['variables'] ?? null;

      $em = getEntityManager();

      $schema = SchemaFactory::create($em);  // Создаем схему
      $result = GraphQL::executeQuery($schema, $query, null, null, $variables);  // Выполняем запрос GraphQL

      header('Content-Type: application/json');
      echo json_encode($result->toArray());  // Возвращаем результат в формате JSON
    } catch (\Throwable $e) {
      header('Content-Type: application/json');
      echo json_encode(['error' => $e->getMessage()]);
    }
  }
}
