<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id int parts string name
 * @return InputFile
 */

final class InputFileBig extends Instance {
	public function request(int $id,int $parts,string $name) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfa4f0bb5);
		$writer->writeLong($id);
		$writer->writeInt($parts);
		$writer->tgwriteBytes($name);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['parts'] = $reader->readInt();
		$result['name'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>