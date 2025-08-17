<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id int parts string md5_checksum bytes file_hash bytes secret
 * @return InputSecureFile
 */

final class InputSecureFileUploaded extends Instance {
	public function request(int $id,int $parts,string $md5_checksum,string $file_hash,string $secret) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3334b0f0);
		$writer->writeLong($id);
		$writer->writeInt($parts);
		$writer->tgwriteBytes($md5_checksum);
		$writer->tgwriteBytes($file_hash);
		$writer->tgwriteBytes($secret);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['parts'] = $reader->readInt();
		$result['md5_checksum'] = $reader->tgreadBytes();
		$result['file_hash'] = $reader->tgreadBytes();
		$result['secret'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>