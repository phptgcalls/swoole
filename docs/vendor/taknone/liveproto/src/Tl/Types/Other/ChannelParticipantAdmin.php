<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id long promoted_by int date chatadminrights admin_rights true can_edit true self long inviter_id string rank
 * @return ChannelParticipant
 */

final class ChannelParticipantAdmin extends Instance {
	public function request(int $user_id,int $promoted_by,int $date,object $admin_rights,? true $can_edit = null,? true $self = null,? int $inviter_id = null,? string $rank = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x34c3bb53);
		$flags = 0;
		$flags |= is_null($can_edit) ? 0 : (1 << 0);
		$flags |= is_null($self) ? 0 : (1 << 1);
		$flags |= is_null($inviter_id) ? 0 : (1 << 1);
		$flags |= is_null($rank) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->writeLong($user_id);
		if(is_null($inviter_id) === false):
			$writer->writeLong($inviter_id);
		endif;
		$writer->writeLong($promoted_by);
		$writer->writeInt($date);
		$writer->write($admin_rights->read());
		if(is_null($rank) === false):
			$writer->tgwriteBytes($rank);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['can_edit'] = true;
		else:
			$result['can_edit'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['self'] = true;
		else:
			$result['self'] = false;
		endif;
		$result['user_id'] = $reader->readLong();
		if($flags & (1 << 1)):
			$result['inviter_id'] = $reader->readLong();
		else:
			$result['inviter_id'] = null;
		endif;
		$result['promoted_by'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		$result['admin_rights'] = $reader->tgreadObject();
		if($flags & (1 << 2)):
			$result['rank'] = $reader->tgreadBytes();
		else:
			$result['rank'] = null;
		endif;
		return new self($result);
	}
}

?>