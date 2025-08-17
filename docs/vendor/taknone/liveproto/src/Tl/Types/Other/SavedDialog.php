<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int top_message true pinned
 * @return SavedDialog
 */

final class SavedDialog extends Instance {
	public function request(object $peer,int $top_message,? true $pinned = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbd87cb6c);
		$flags = 0;
		$flags |= is_null($pinned) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($top_message);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['pinned'] = true;
		else:
			$result['pinned'] = false;
		endif;
		$result['peer'] = $reader->tgreadObject();
		$result['top_message'] = $reader->readInt();
		return new self($result);
	}
}

?>