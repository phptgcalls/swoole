<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id int parts string md5_checksum int key_fingerprint
 * @return InputEncryptedFile
 */

final class InputEncryptedFileUploaded extends Instance {
	public function request(int $id,int $parts,string $md5_checksum,int $key_fingerprint) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x64bd0306);
		$writer->writeLong($id);
		$writer->writeInt($parts);
		$writer->tgwriteBytes($md5_checksum);
		$writer->writeInt($key_fingerprint);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['parts'] = $reader->readInt();
		$result['md5_checksum'] = $reader->tgreadBytes();
		$result['key_fingerprint'] = $reader->readInt();
		return new self($result);
	}
}

?>