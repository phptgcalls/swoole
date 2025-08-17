<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash long size int dc_id int key_fingerprint
 * @return EncryptedFile
 */

final class EncryptedFile extends Instance {
	public function request(int $id,int $access_hash,int $size,int $dc_id,int $key_fingerprint) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa8008cd8);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->writeLong($size);
		$writer->writeInt($dc_id);
		$writer->writeInt($key_fingerprint);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['size'] = $reader->readLong();
		$result['dc_id'] = $reader->readInt();
		$result['key_fingerprint'] = $reader->readInt();
		return new self($result);
	}
}

?>