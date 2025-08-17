<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputdocument id bool unfave
 * @return Bool
 */

final class FaveSticker extends Instance {
	public function request(object $id,bool $unfave) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb9ffc55b);
		$writer->write($id->read());
		$writer->tgwriteBool($unfave);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>