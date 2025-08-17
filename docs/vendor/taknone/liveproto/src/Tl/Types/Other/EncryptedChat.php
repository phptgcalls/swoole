<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id long access_hash int date long admin_id long participant_id bytes g_a_or_b long key_fingerprint
 * @return EncryptedChat
 */

final class EncryptedChat extends Instance {
	public function request(int $id,int $access_hash,int $date,int $admin_id,int $participant_id,string $g_a_or_b,int $key_fingerprint) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x61f0d4c7);
		$writer->writeInt($id);
		$writer->writeLong($access_hash);
		$writer->writeInt($date);
		$writer->writeLong($admin_id);
		$writer->writeLong($participant_id);
		$writer->tgwriteBytes($g_a_or_b);
		$writer->writeLong($key_fingerprint);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readInt();
		$result['access_hash'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		$result['admin_id'] = $reader->readLong();
		$result['participant_id'] = $reader->readLong();
		$result['g_a_or_b'] = $reader->tgreadBytes();
		$result['key_fingerprint'] = $reader->readLong();
		return new self($result);
	}
}

?>