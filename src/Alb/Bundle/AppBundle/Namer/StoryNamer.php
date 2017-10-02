<?php

namespace Alb\Bundle\AppBundle\Namer;

use Vich\UploaderBundle\Naming\NamerInterface;

class StoryNamer implements NamerInterface
{
	/**
     * Creates a name for the file being uploaded.
     *
     * @param object $obj The object the upload is attached to.
     * @param string $field The name of the uploadable field to generate a name for.
     * @return string The file name.
     */
    function name($obj, $field)
    {
        $file = $obj->file;
        $extension = $file->getExtension();

        return uniqid('', true).'.'.$extension;
    }
}