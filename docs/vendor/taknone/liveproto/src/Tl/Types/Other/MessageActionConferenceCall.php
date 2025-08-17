<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long call_id true missed true active true video int duration Vector<Peer> other_participants
 * @return MessageAction
 */

final class MessageActionConferenceCall extends Instance {
	public function request(int $call_id,? true $missed = null,? true $active = null,? true $video = null,? int $duration = null,? array $other_participants = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2ffe2f7a);
		$flags = 0;
		$flags |= is_null($missed) ? 0 : (1 << 0);
		$flags |= is_null($active) ? 0 : (1 << 1);
		$flags |= is_null($video) ? 0 : (1 << 4);
		$flags |= is_null($duration) ? 0 : (1 << 2);
		$flags |= is_null($other_participants) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->writeLong($call_id);
		if(is_null($duration) === false):
			$writer->writeInt($duration);
		endif;
		if(is_null($other_participants) === false):
			$writer->tgwriteVector($other_participants,'Peer');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['missed'] = true;
		else:
			$result['missed'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['active'] = true;
		else:
			$result['active'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['video'] = true;
		else:
			$result['video'] = false;
		endif;
		$result['call_id'] = $reader->readLong();
		if($flags & (1 << 2)):
			$result['duration'] = $reader->readInt();
		else:
			$result['duration'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['other_participants'] = $reader->tgreadVector('Peer');
		else:
			$result['other_participants'] = null;
		endif;
		return new self($result);
	}
}

?>