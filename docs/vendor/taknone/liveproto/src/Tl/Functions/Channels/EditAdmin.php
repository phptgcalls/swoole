<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel inputuser user_id chatadminrights admin_rights string rank
 * @return Updates
 */

final class EditAdmin extends Instance {
	public function request(object $channel,object $user_id,object $admin_rights,string $rank) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd33c8902);
		$writer->write($channel->read());
		$writer->write($user_id->read());
		$writer->write($admin_rights->read());
		$writer->tgwriteBytes($rank);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>