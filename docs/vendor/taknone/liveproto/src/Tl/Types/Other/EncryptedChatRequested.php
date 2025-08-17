<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id long access_hash int date long admin_id long participant_id bytes g_a int folder_id
 * @return EncryptedChat
 */

final class EncryptedChatRequested extends Instance {
	public function request(int $id,int $access_hash,int $date,int $admin_id,int $participant_id,string $g_a,? int $folder_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x48f1d94c);
		$flags = 0;
		$flags |= is_null($folder_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($folder_id) === false):
			$writer->writeInt($folder_id);
		endif;
		$writer->writeInt($id);
		$writer->writeLong($access_hash);
		$writer->writeInt($date);
		$writer->writeLong($admin_id);
		$writer->writeLong($participant_id);
		$writer->tgwriteBytes($g_a);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['folder_id'] = $reader->readInt();
		else:
			$result['folder_id'] = null;
		endif;
		$result['id'] = $reader->readInt();
		$result['access_hash'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		$result['admin_id'] = $reader->readLong();
		$result['participant_id'] = $reader->readLong();
		$result['g_a'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>