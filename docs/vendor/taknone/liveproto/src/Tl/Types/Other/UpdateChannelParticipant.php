<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id int date long actor_id long user_id int qts true via_chatlist channelparticipant prev_participant channelparticipant new_participant exportedchatinvite invite
 * @return Update
 */

final class UpdateChannelParticipant extends Instance {
	public function request(int $channel_id,int $date,int $actor_id,int $user_id,int $qts,? true $via_chatlist = null,? object $prev_participant = null,? object $new_participant = null,? object $invite = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x985d3abb);
		$flags = 0;
		$flags |= is_null($via_chatlist) ? 0 : (1 << 3);
		$flags |= is_null($prev_participant) ? 0 : (1 << 0);
		$flags |= is_null($new_participant) ? 0 : (1 << 1);
		$flags |= is_null($invite) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeLong($channel_id);
		$writer->writeInt($date);
		$writer->writeLong($actor_id);
		$writer->writeLong($user_id);
		if(is_null($prev_participant) === false):
			$writer->write($prev_participant->read());
		endif;
		if(is_null($new_participant) === false):
			$writer->write($new_participant->read());
		endif;
		if(is_null($invite) === false):
			$writer->write($invite->read());
		endif;
		$writer->writeInt($qts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 3)):
			$result['via_chatlist'] = true;
		else:
			$result['via_chatlist'] = false;
		endif;
		$result['channel_id'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		$result['actor_id'] = $reader->readLong();
		$result['user_id'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['prev_participant'] = $reader->tgreadObject();
		else:
			$result['prev_participant'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['new_participant'] = $reader->tgreadObject();
		else:
			$result['new_participant'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['invite'] = $reader->tgreadObject();
		else:
			$result['invite'] = null;
		endif;
		$result['qts'] = $reader->readInt();
		return new self($result);
	}
}

?>