<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true by_location true check_limit true for_personal
 * @return messages.Chats
 */

final class GetAdminedPublicChannels extends Instance {
	public function request(? true $by_location = null,? true $check_limit = null,? true $for_personal = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf8b036af);
		$flags = 0;
		$flags |= is_null($by_location) ? 0 : (1 << 0);
		$flags |= is_null($check_limit) ? 0 : (1 << 1);
		$flags |= is_null($for_personal) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>