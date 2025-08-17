<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return Vector<DialogFilterSuggested>
 */

final class GetSuggestedDialogFilters extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa29cd42c);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>