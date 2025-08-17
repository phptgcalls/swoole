<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id long access_hash int date long admin_id long participant_id phonecallprotocol protocol true video int receive_date
 * @return PhoneCall
 */

final class PhoneCallWaiting extends Instance {
	public function request(int $id,int $access_hash,int $date,int $admin_id,int $participant_id,object $protocol,? true $video = null,? int $receive_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc5226f17);
		$flags = 0;
		$flags |= is_null($video) ? 0 : (1 << 6);
		$flags |= is_null($receive_date) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->writeLong($access_hash);
		$writer->writeInt($date);
		$writer->writeLong($admin_id);
		$writer->writeLong($participant_id);
		$writer->write($protocol->read());
		if(is_null($receive_date) === false):
			$writer->writeInt($receive_date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 6)):
			$result['video'] = true;
		else:
			$result['video'] = false;
		endif;
		$result['id'] = $reader->readLong();
		$result['access_hash'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		$result['admin_id'] = $reader->readLong();
		$result['participant_id'] = $reader->readLong();
		$result['protocol'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['receive_date'] = $reader->readInt();
		else:
			$result['receive_date'] = null;
		endif;
		return new self($result);
	}
}

?>