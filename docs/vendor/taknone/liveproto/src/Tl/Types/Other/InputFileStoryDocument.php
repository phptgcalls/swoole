<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputdocument id
 * @return InputFile
 */

final class InputFileStoryDocument extends Instance {
	public function request(object $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x62dc8b48);
		$writer->write($id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>