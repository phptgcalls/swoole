<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param updates updates Vector<MissingInvitee> missing_invitees
 * @return messages.InvitedUsers
 */

final class InvitedUsers extends Instance {
	public function request(object $updates,array $missing_invitees) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7f5defa6);
		$writer->write($updates->read());
		$writer->tgwriteVector($missing_invitees,'MissingInvitee');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['updates'] = $reader->tgreadObject();
		$result['missing_invitees'] = $reader->tgreadVector('MissingInvitee');
		return new self($result);
	}
}

?>