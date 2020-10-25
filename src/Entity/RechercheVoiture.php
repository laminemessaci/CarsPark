<?php
namespace App\Entity;

class RechercheVoiture{
    private $minAnnee;
    private $maxAnnee;

    /**
     * @return int
     */
    public function getMinAnnee(): int
    {
        return $this->minAnnee;
    }

    /**
     * @param int  $minAnnee
     */
    public function setMinAnnee(int $minAnnee): void
    {
        $this->minAnnee = $minAnnee;
    }

    /**
     * @return int
     */
    public function getMaxAnnee(): int
    {
        return $this->maxAnnee;
    }

    /**
     * @param int $maxAnnee
     */
    public function setMaxAnnee(int $maxAnnee): void
    {
        $this->maxAnnee = $maxAnnee;
    }

}
