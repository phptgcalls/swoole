<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long admin_id int invites_count int revoked_invites_count
 * @return ChatAdminWithInvites
 */

final class ChatAdminWithInvites extends Instance {
	public function request(int $admin_id,int $invites_count,int $revoked_invites_count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf2ecef23);
		$writer->writeLong($admin_id);
		$writer->writeInt($invites_count);
		$writer->writeInt($revoked_invites_count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['admin_id'] = $reader->readLong();
		$result['invites_count'] = $reader->readInt();
		$result['revoked_invites_count'] = $reader->readInt();
		return new self($result);
	}
}

?>