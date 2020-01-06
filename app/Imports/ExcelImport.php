<?php
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Importable;
use App\Produtos;

class ExcelImport implements ToCollection, WithChunkReading, ShouldQueue,WithStartRow
{
      public function model(array $row)
      {
          return new Produtos([
              'code' => $row['lm'],
              'name' => $row['name'],
              'free_shipping' => $row['free_shipping'],
              'description' => $row['description'],
              'price' => $row['price'],
          ]);
      }

      public function batchSize(): int
      {
          return 1000;
      }

      public function chunkSize(): int
      {
          return 1000;
      }
}
