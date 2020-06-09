<?php

declare(strict_types=1);

namespace PoP\QueriedObject\TypeAPIs;

use PoP\ComponentModel\Feedback\Tokens;
use PoP\ComponentModel\Facades\Schema\FeedbackMessageStoreFacade;
use PoP\Translation\Facades\TranslationAPIFacade;

class TypeAPIUtils
{
    /**
     * Return the minimum number from between the request limit and the max limit.
     * If the max limit is breached, allow to add a warning to the response
     *
     * @param integer|null $limit
     * @param integer|null $maxLimit
     * @param boolean $addSchemaWarning
     * @return integer|null
     */
    public static function getLimitOrMaxLimit(
        ?int $limit,
        ?int $maxLimit,
        bool $addSchemaWarning = true
    ): ?int {
        // -1 means "unlimited"
        if (!is_null($maxLimit) && $maxLimit != -1 && ($limit == -1 || $limit > $maxLimit)) {
            // Add a warning in the query response
            if ($addSchemaWarning) {
                $translationAPI = TranslationAPIFacade::getInstance();
                $schemaWarnings = [];
                $schemaWarnings[] = [
                    // Tokens::PATH => [$typeField],
                    Tokens::MESSAGE => sprintf(
                        $translationAPI->__('Using max limit of \'%s\' instead of requested limit of \'%s\'', 'posts'),
                        $maxLimit,
                        $limit
                    ),
                ];
                $feedbackMessageStore = FeedbackMessageStoreFacade::getInstance();
                $feedbackMessageStore->addSchemaWarnings($schemaWarnings);
            }
            $limit = $maxLimit;
        }
        return $limit;
    }
}
