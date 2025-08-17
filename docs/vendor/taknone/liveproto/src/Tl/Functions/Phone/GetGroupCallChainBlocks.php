<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call int sub_chain_id int offset int limit
 * @return Updates
 */

final class GetGroupCallChainBlocks extends Instance {
	public function request(object $call,int $sub_chain_id,int $offset,int $limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xee9f88a6);
		$writer->write($call->read());
		$writer->writeInt($sub_chain_id);
		$writer->writeInt($offset);
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>