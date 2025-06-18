<?php

class pathFinder
{
    private array $map;
    private array $processedList;  // уже обработанные точки

    public function __construct(array $map)
    {
        $this->map = $map;
        $this->processedList = [];
    }

    /**
     * @param array $a
     * @param array $b
     * @return bool
     */
    public function pathExists(array $a, array $b): bool
    {
        // одна из начальных точек вне карты или "стена"
        if (!$this->isWay($a) || !$this->isWay($b)) {
            return false;
        }
        // это одна и та же точка
        if ($this->goal($a, $b)) {
            return true;
        }
        $this->processedList = [$a];

        return $this->walk($a, $b);
    }

    /**
     * Рекурсивный поиск пути
     * @param array $a
     * @param array $b
     * @return bool
     */
    private function walk(array $a, array $b): bool
    {
        $checkList = [
            [$a[0] - 1, $a[1]], // точка выше
            [$a[0] + 1, $a[1]], // точка ниже
            [$a[0], $a[1] - 1], // точка слева
            [$a[0], $a[1] + 1]  // точка справа
        ];
        foreach ($checkList as $point) {
            if (
                $this->isWay($point) &&     // "дорожка"
                !$this->isProcessed($point) // точку ещё не проверяли
            ) {
                $this->processedList[] = $point;
                if (
                    $this->goal($point, $b) ||  // пришли к цели
                    $this->walk($point, $b)     // или рекурсивно нашли дальше
                ) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Точка является "дорожкой"?
     * @param array $point
     * @return bool
     */
    private function isWay(array $point): bool
    {
        return isset($this->map[$point[0]][$point[1]]) &&   // точка находится внутри карты
            $this->map[$point[0]][$point[1]] === '_';       // "дорожка"
    }

    /**
     * Проверка на совпадение точек
     * @param array $a
     * @param array $b
     * @return bool
     */
    private function goal(array $a, array $b): bool
    {
        return $a[0] === $b[0] && $a[1] === $b[1];
    }

    /**
     * Точка уже проверялась?
     * @param array $point
     * @return bool
     */
    private function isProcessed(array $point): bool
    {
        return in_array($point, $this->processedList, true);
    }
}
