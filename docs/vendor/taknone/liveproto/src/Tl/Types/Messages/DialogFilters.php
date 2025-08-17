<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<DialogFilter> filters true tags_enabled
 * @return messages.DialogFilters
 */

final class DialogFilters extends Instance {
	public function request(array $filters,? true $tags_enabled = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2ad93719);
		$flags = 0;
		$flags |= is_null($tags_enabled) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteVector($filters,'DialogFilter');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['tags_enabled'] = true;
		else:
			$result['tags_enabled'] = false;
		endif;
		$result['filters'] = $reader->tgreadVector('DialogFilter');
		return new self($result);
	}
}

?>