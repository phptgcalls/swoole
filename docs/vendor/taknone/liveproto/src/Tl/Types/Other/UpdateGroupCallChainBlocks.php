<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call int sub_chain_id Vector<bytes> blocks int next_offset
 * @return Update
 */

final class UpdateGroupCallChainBlocks extends Instance {
	public function request(object $call,int $sub_chain_id,array $blocks,int $next_offset) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa477288f);
		$writer->write($call->read());
		$writer->writeInt($sub_chain_id);
		$writer->tgwriteVector($blocks,'bytes');
		$writer->writeInt($next_offset);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['call'] = $reader->tgreadObject();
		$result['sub_chain_id'] = $reader->readInt();
		$result['blocks'] = $reader->tgreadVector('bytes');
		$result['next_offset'] = $reader->readInt();
		return new self($result);
	}
}

?>