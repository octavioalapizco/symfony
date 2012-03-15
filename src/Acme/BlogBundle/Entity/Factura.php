<?php

namespace Acme\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\BlogBundle\Entity\Factura
 */
class Factura
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $rfc_e
     */
    private $rfc_e;

    /**
     * @var string $fecha_emision
     */
    private $fecha_emision;

    /**
     * @var string $serie
     */
    private $serie;

    /**
     * @var integer $folio
     */
    private $folio;

    /**
     * @var decimal $total_antes_dimpuestos
     */
    private $total_antes_dimpuestos;

    /**
     * @var decimal $i_traladados
     */
    private $i_traladados;

    /**
     * @var decimal $i_retenidos
     */
    private $i_retenidos;

    /**
     * @var decimal $total
     */
    private $total;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set rfc_e
     *
     * @param string $rfcE
     */
    public function setRfcE($rfcE)
    {
        $this->rfc_e = $rfcE;
    }

    /**
     * Get rfc_e
     *
     * @return string 
     */
    public function getRfcE()
    {
        return $this->rfc_e;
    }

    /**
     * Set fecha_emision
     *
     * @param string $fechaEmision
     */
    public function setFechaEmision($fechaEmision)
    {
        $this->fecha_emision = $fechaEmision;
    }

    /**
     * Get fecha_emision
     *
     * @return string 
     */
    public function getFechaEmision()
    {
        return $this->fecha_emision;
    }

    /**
     * Set serie
     *
     * @param string $serie
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;
    }

    /**
     * Get serie
     *
     * @return string 
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set folio
     *
     * @param integer $folio
     */
    public function setFolio($folio)
    {
        $this->folio = $folio;
    }

    /**
     * Get folio
     *
     * @return integer 
     */
    public function getFolio()
    {
        return $this->folio;
    }

    /**
     * Set total_antes_dimpuestos
     *
     * @param decimal $totalAntesDimpuestos
     */
    public function setTotalAntesDimpuestos($totalAntesDimpuestos)
    {
        $this->total_antes_dimpuestos = $totalAntesDimpuestos;
    }

    /**
     * Get total_antes_dimpuestos
     *
     * @return decimal 
     */
    public function getTotalAntesDimpuestos()
    {
        return $this->total_antes_dimpuestos;
    }

    /**
     * Set i_traladados
     *
     * @param decimal $iTraladados
     */
    public function setITraladados($iTraladados)
    {
        $this->i_traladados = $iTraladados;
    }

    /**
     * Get i_traladados
     *
     * @return decimal 
     */
    public function getITraladados()
    {
        return $this->i_traladados;
    }

    /**
     * Set i_retenidos
     *
     * @param decimal $iRetenidos
     */
    public function setIRetenidos($iRetenidos)
    {
        $this->i_retenidos = $iRetenidos;
    }

    /**
     * Get i_retenidos
     *
     * @return decimal 
     */
    public function getIRetenidos()
    {
        return $this->i_retenidos;
    }

    /**
     * Set total
     *
     * @param decimal $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * Get total
     *
     * @return decimal 
     */
    public function getTotal()
    {
        return $this->total;
    }
}