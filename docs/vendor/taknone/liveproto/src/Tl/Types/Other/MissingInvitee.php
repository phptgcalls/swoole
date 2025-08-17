<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id true premium_would_allow_invite true premium_required_for_pm
 * @return MissingInvitee
 */

final class MissingInvitee extends Instance {
	public function request(int $user_id,? true $premium_would_allow_invite = null,? true $premium_required_for_pm = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x628c9224);
		$flags = 0;
		$flags |= is_null($premium_would_allow_invite) ? 0 : (1 << 0);
		$flags |= is_null($premium_required_for_pm) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($user_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['premium_would_allow_invite'] = true;
		else:
			$result['premium_would_allow_invite'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['premium_required_for_pm'] = true;
		else:
			$result['premium_required_for_pm'] = false;
		endif;
		$result['user_id'] = $reader->readLong();
		return new self($result);
	}
}

?>