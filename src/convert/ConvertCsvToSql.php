<?php

namespace TaskForce\convert;

class ConvertCsvToSql
{
    private $csvFileContent;
    private $csvFileName;
    private $sqlFile;
    private $extension = '.csv';

    public function __construct(string $pathCsv, string $pathSql)
    {
        $this->csvFileContent = new \SplFileObject($pathCsv);

        $this->csvFileName = basename($pathCsv, '.csv');

        $this->sqlFile = new \SplFileObject($pathSql, 'w');
    }

    public function getCsvFileName(): string
    {
        return $this->csvFileName;
    }

    public function getHeaders(): array
    {
        $this->csvFileContent->rewind();
        return $this->csvFileContent->fgetcsv();
    }

    public function getRows(): array
    {

        $this->csvFileContent->rewind();
        $this->csvFileContent->next();
        $this->csvFileContent->current();

        while (!$this->csvFileContent->eof()) {
            $content[] = array_filter($this->csvFileContent->fgetcsv());
        }

        $content = array_filter($content);

        var_dump($content);

        foreach ($content as $value) {
            $values[] = implode(',', array_map(function ($value) {
                return "'{$value}'";
            }, $value));

            $result = array_map(function ($item) {
                return "($item)";
            }, $values);
        }

        return $result;
    }

    public function getSqlQuery(): string
    {

        $format = 'INSERT INTO `%1$s` (%2$s) VALUES %3$s;';

        $sqlQuery = sprintf($format, $this->getCsvFileName(), implode(',', $this->getHeaders()), implode(',' . PHP_EOL, $this->getRows()));

        return $sqlQuery;
    }

    public function writeSqlFile(): void
    {
        $sqlQuery = $this->getSqlQuery();
        $this->sqlFile->fwrite($sqlQuery);
    }

}
