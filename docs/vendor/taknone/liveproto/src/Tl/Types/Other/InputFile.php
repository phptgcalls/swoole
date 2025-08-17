<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id int parts string name string md5_checksum
 * @return InputFile
 */

final class InputFile extends Instance {
	public function request(int $id,int $parts,string $name,string $md5_checksum) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf52ff27f);
		$writer->writeLong($id);
		$writer->writeInt($parts);
		$writer->tgwriteBytes($name);
		$writer->tgwriteBytes($md5_checksum);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['parts'] = $reader->readInt();
		$result['name'] = $reader->tgreadBytes();
		$result['md5_checksum'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>