<?php

namespace WebMerge\Responses;

use WebMerge\Exceptions\InvalidArgumentException;

class PDFData extends Data {

    /**
     * Download resource contents as a PDF.
     *
     * @param string $filename A filename excluding the .pdf extension.
     */
    public function download($filename)
    {
        if (empty($filename)) {
            throw new InvalidArgumentException(
                'Filename parameter is required.'
            );
        }
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '.pdf"');
        print $this->contents;
        exit;
    }

    /**
     * Save resource contents to the file system.
     *
     * @param string $filename A path to save the data too.
     *
     * @return mixed The bytes that were written or FALSE.
     */
    public function save($filename)
    {
        if (empty($filename)) {
            throw new InvalidArgumentException(
                'Filename parameter is required.'
            );
        }

        return file_put_contents($filename, $this->contents);
    }
}
