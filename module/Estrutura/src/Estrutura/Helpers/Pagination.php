<?php

namespace Estrutura\Helpers;

/**
 *
 * @author anonymous
 *
 */
class Pagination {

    /**
     * Converte array multidimencional $_FILE por atributos (tmp_name, size...)
     * em um array multidimencional por arquivo
     * @param unknown_type $files
     * @return array
     */
    public static function getCountPerPage($totalItemCount) {

        $values = [200, 100, 50, 25, 10] ;

        return array_reverse($values);
    }

    

}
