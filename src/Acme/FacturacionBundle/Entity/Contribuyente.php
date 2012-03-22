<?php

namespace Acme\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Acme\BlogBundle\Entity\Contribuyente
 *
 * @ORM\Table(name="contribuyente")
 * @ORM\Entity
 */
class Contribuyente
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string $tipo
     *
     * @ORM\Column(name="tipo", type="string", nullable=false)
     */
    private $tipo;

    /**
     * @var string $rfc
     *
     * @ORM\Column(name="rfc", type="string", length=15, nullable=false)
     */
    private $rfc;

    /**
     * @var string $nombreFiscal
     *
     * @ORM\Column(name="nombre_fiscal", type="string", length=255, nullable=false)
     */
    private $nombreFiscal;

    /**
     * @var string $nombreComercial
     *
     * @ORM\Column(name="nombre_comercial", type="string", length=255, nullable=false)
     */
    private $nombreComercial;

    /**
     * @var string $regimenes
     *
     * @ORM\Column(name="regimenes", type="string", length=255, nullable=true)
     */
    private $regimenes;

    /**
     * @var string $pais
     *
     * @ORM\Column(name="pais", type="string", length=255, nullable=false)
     */
    private $pais;

    /**
     * @var string $estado
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado;

    /**
     * @var string $ciudad
     *
     * @ORM\Column(name="ciudad", type="string", length=255, nullable=true)
     */
    private $ciudad;

    /**
     * @var string $localidad
     *
     * @ORM\Column(name="localidad", type="string", length=255, nullable=true)
     */
    private $localidad;

    /**
     * @var string $codigoPostal
     *
     * @ORM\Column(name="codigo_postal", type="string", length=10, nullable=false)
     */
    private $codigoPostal;

    /**
     * @var string $colonia
     *
     * @ORM\Column(name="colonia", type="string", length=255, nullable=false)
     */
    private $colonia;

    /**
     * @var string $calle
     *
     * @ORM\Column(name="calle", type="string", length=255, nullable=false)
     */
    private $calle;

    /**
     * @var string $numExt
     *
     * @ORM\Column(name="num_ext", type="string", length=255, nullable=false)
     */
    private $numExt;

    /**
     * @var string $numInt
     *
     * @ORM\Column(name="num_int", type="string", length=255, nullable=true)
     */
    private $numInt;


}