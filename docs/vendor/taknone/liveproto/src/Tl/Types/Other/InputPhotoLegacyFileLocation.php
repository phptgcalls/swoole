<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash bytes file_reference long volume_id int local_id long secret
 * @return InputFileLocation
 */

final class InputPhotoLegacyFileLocation extends Instance {
	public function request(int $id,int $access_hash,string $file_reference,int $volume_id,int $local_id,int $secret) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd83466f3);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->tgwriteBytes($file_reference);
		$writer->writeLong($volume_id);
		$writer->writeInt($local_id);
		$writer->writeLong($secret);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['file_reference'] = $reader->tgreadBytes();
		$result['volume_id'] = $reader->readLong();
		$result['local_id'] = $reader->readInt();
		$result['secret'] = $reader->readLong();
		return new self($result);
	}
}

?>