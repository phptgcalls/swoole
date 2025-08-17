<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash long size int dc_id int date bytes file_hash bytes secret
 * @return SecureFile
 */

final class SecureFile extends Instance {
	public function request(int $id,int $access_hash,int $size,int $dc_id,int $date,string $file_hash,string $secret) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7d09c27e);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->writeLong($size);
		$writer->writeInt($dc_id);
		$writer->writeInt($date);
		$writer->tgwriteBytes($file_hash);
		$writer->tgwriteBytes($secret);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['size'] = $reader->readLong();
		$result['dc_id'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		$result['file_hash'] = $reader->tgreadBytes();
		$result['secret'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>