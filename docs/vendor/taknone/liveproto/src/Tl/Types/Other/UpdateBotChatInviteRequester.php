<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer int date long user_id string about exportedchatinvite invite int qts
 * @return Update
 */

final class UpdateBotChatInviteRequester extends Instance {
	public function request(object $peer,int $date,int $user_id,string $about,object $invite,int $qts) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x11dfa986);
		$writer->write($peer->read());
		$writer->writeInt($date);
		$writer->writeLong($user_id);
		$writer->tgwriteBytes($about);
		$writer->write($invite->read());
		$writer->writeInt($qts);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['date'] = $reader->readInt();
		$result['user_id'] = $reader->readLong();
		$result['about'] = $reader->tgreadBytes();
		$result['invite'] = $reader->tgreadObject();
		$result['qts'] = $reader->readInt();
		return new self($result);
	}
}

?>