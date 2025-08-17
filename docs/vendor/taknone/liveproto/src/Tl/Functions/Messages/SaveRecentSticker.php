<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputdocument id bool unsave true attached
 * @return Bool
 */

final class SaveRecentSticker extends Instance {
	public function request(object $id,bool $unsave,? true $attached = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x392718f8);
		$flags = 0;
		$flags |= is_null($attached) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($id->read());
		$writer->tgwriteBool($unsave);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>