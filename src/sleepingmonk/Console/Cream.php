<?php

/**
 * @file
 * Contains \sleepingmonk\Console\Cream.
 */

namespace sleepingmonk\Console;

use LucidFrame\Console\ConsoleTable;

/**
 * Class Cream
 */
class Cream {

  private $filename;

  private $dimensions;

  private $items;

  private $json;

  private $data;

  public function __construct(string $filename) {
    $this->filename = $filename;

    $this->json = file_get_contents($this->filename);
    $this->data = json_decode($this->json, true);

    if (!empty($this->data)) {
      foreach ($this->data as $item) {
        $this->items[] = $item['name'];

        foreach ($item['dimensions'] as $dimension => $value) {
          $this->dimensions[] = $dimension;
        }

        $this->dimensions = array_unique($this->dimensions);
      }
    }
  }

  public function addItem($item) {
    $this->items[] = $item;
  }

  public function getItems() {
    return $this->items;
  }

  public function addDimension($dimension) {
    $this->dimensions[] = $dimension;
  }

  public function getDimensions() {
    return $this->dimensions;
  }

  public function increment($name, $dimension) {
    $exists = false;
    if (!empty($this->data)) {
      foreach ($this->data as $i => $item) {
        if ($item['name'] == $name) {
          $exists = true;

          if (!array_key_exists($dimension, $this->data[$i]['dimensions'])) {
            $this->data[$i]['dimensions'][$dimension] = 0;
          }

          $this->data[$i]['dimensions'][$dimension]++;
        }
      }
    }

    if (!$exists) {
      $this->data[] = [
        'name' => $name,
        'dimensions' => [
          $dimension => 1,
        ],
      ];
    }
  }

  public function getData() {
    return $this->data;
  }

  public function writeJson() {
    $this->json = fopen($this->filename, 'w');
    fwrite($this->json, json_encode($this->data));
    fclose($this->json);
  }

  public function report() {
    $table = new ConsoleTable();
    $table->addHeader('Item');
    $dimensions = $this->getDimensions();
    $data = $this->getData();

    if (!empty($dimensions)) {
      foreach ($dimensions as $dimension) {
        $table->addHeader($dimension);
      }
    }

    $table->addHeader('Total');

    if (!empty($data)) {
      foreach ($data as $item) {
        $tally = 0;
        $table->addRow();
        $table->addColumn($item['name']);
        foreach ($dimensions as $dimension) {
          if (array_key_exists($dimension, $item['dimensions'])) {
            $tally += $item['dimensions'][$dimension];
            $table->addColumn($item['dimensions'][$dimension]);
            continue;
          }
          $table->addColumn(0);
        }
        $table->addColumn($tally);
      }
    }

    $table->display();
  }

}
