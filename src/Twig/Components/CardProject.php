<?php

namespace App\Twig\Components;

use App\Entity\Project;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class CardProject
{
    public Project $project;
}
